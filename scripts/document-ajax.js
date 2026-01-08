/**
     * Document AJAX filtering and pagination
     * Handles filtering documents by year and pagination with 3 items per page
     */
(function($) {
    'use strict';

    // Store the current state
    var currentState = {
        year: '',
        paged: 1
    };

    // Function to update document table via AJAX
    function updateDocumentTable() {
        var $tableContainer = $('#document-table-ajax');
        
        // Add loading state
        $tableContainer.addClass('loading');
        if (!$tableContainer.find('.loader-overlay').length) {
            $tableContainer.append('<div class="loader-overlay"><div class="loader"></div></div>');
        }

        // Get variables
        var termId = $tableContainer.data('term-id') !== undefined ? $tableContainer.data('term-id') : 0;
        // Priority check for #current-term-id if exists (legacy support)
        if ($('#current-term-id').length && $('#current-term-id').data('term-id') !== undefined) {
             termId = $('#current-term-id').data('term-id');
        }
        
        var postType = $tableContainer.data('post-type') || 'co-dong';
        var taxonomy = $tableContainer.data('taxonomy') || 'co-dong-category';
        var perPage = $tableContainer.data('per-page') || 10;

        // Prepare AJAX request
        $.ajax({
            url: (typeof ajax_object !== 'undefined') ? ajax_object.ajax_url : ajaxurl,
            type: 'POST',
            dataType: 'html',
            data: {
                action: 'filter_documents',
                term_id: termId,
                year: currentState.year,
                paged: currentState.paged,
                per_page: perPage,
                post_type: postType,
                taxonomy: taxonomy,
                nonce: (typeof ajax_object !== 'undefined') ? ajax_object.nonce : ''
            },
            success: function(response) {
                // Update the table container with the response
                $tableContainer.html(response);
                
                // Update URL with current state (for browser history)
                updateURL();
                
                // Remove loading state
                $tableContainer.removeClass('loading');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $tableContainer.html('<div class="error-message">Error loading documents. Please try again.</div>');
                $tableContainer.removeClass('loading');
            }
        });
    }

    // Update URL parameters without reloading the page
    function updateURL() {
        if (history.pushState) {
            var url = new URL(window.location.href);
            
            // Update or remove year parameter
            if (currentState.year) {
                url.searchParams.set('year', currentState.year);
            } else {
                url.searchParams.delete('year');
            }
            
            // Update or remove paged parameter
            if (currentState.paged > 1) {
                url.searchParams.set('paged', currentState.paged);
            } else {
                url.searchParams.delete('paged');
            }
            
            // Update browser history
            window.history.replaceState({}, '', url);
        }
    }

    // Initialize from URL parameters
    function initFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        
        // Get year from URL
        if (urlParams.has('year')) {
            currentState.year = urlParams.get('year');
            $('#year-filter').val(currentState.year);
        }
        
        // Get page from URL
        if (urlParams.has('paged')) {
            currentState.paged = parseInt(urlParams.get('paged')) || 1;
        }
    }

    // Add CSS for loading indicator
    function addStyles() {
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                #document-table-ajax.loading { position: relative; min-height: 100px; }
                #document-table-ajax .loader-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(255,255,255,0.7);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 10;
                }
                #document-table-ajax .loader {
                    border: 5px solid #f3f3f3;
                    border-top: 5px solid #3498db;
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    animation: spin 2s linear infinite;
                }
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
                #document-table-ajax .error-message {
                    padding: 15px;
                    margin: 20px 0;
                    border: 1px solid #f5c6cb;
                    border-radius: 4px;
                    color: #721c24;
                    background-color: #f8d7da;
                    text-align: center;
                }
            `)
            .appendTo('head');
    }

    // Document ready
    $(function() {
        // Add styles
        addStyles();
        
        // Initialize from URL parameters
        initFromURL();
        
        // Year filter change event
        $(document).on('change', '#year-filter', function() {
            currentState.year = $(this).val();
            currentState.paged = 1; // Reset to first page when filter changes
            updateDocumentTable();
        });
        
        // Pagination click event
        $(document).on('click', '#document-table-ajax .pagination-container .pagination a', function(e) {
            e.preventDefault();
            var page = $(this).data('paged');
            if (page) {
                currentState.paged = page;
                updateDocumentTable();
                
                // Scroll to table top
                $('html, body').animate({
                    scrollTop: $('#document-table-ajax').offset().top - 250
                }, 300);
            }
        });
        
        // Form submit event (for noscript fallback)
        $('#document-filter-form').on('submit', function(e) {
            e.preventDefault();
            currentState.year = $('#year-filter').val();
            currentState.paged = 1;
            updateDocumentTable();
        });
    });

})(jQuery);