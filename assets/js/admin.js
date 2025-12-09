/**
 * サトー建装 管理画面用JavaScript
 * メディアアップローダー、ソート機能
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {

        // =============================================================================
        // Image Uploader
        // =============================================================================
        $('.sato-upload-image').on('click', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            var frame = wp.media({
                title: '画像を選択',
                button: { text: '選択' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + target).val(attachment.id);
                $('#' + target + '_preview').html('<img src="' + attachment.url + '" alt="" style="max-width:100%;">');
                $('[data-target="' + target + '"].sato-remove-image').show();
            });
            frame.open();
        });

        // =============================================================================
        // Image Remover
        // =============================================================================
        $('.sato-remove-image').on('click', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('#' + target).val('');
            $('#' + target + '_preview').html('');
            $(this).hide();
        });

        // =============================================================================
        // Gallery Image Uploader
        // =============================================================================
        $('#add_gallery_images').on('click', function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'ギャラリー画像を選択',
                button: { text: '追加' },
                multiple: true
            });
            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();
                var container = $('#works_gallery_container');
                var ids = $('#works_gallery').val() ? $('#works_gallery').val().split(',') : [];

                attachments.forEach(function(attachment) {
                    if (ids.indexOf(attachment.id.toString()) === -1) {
                        ids.push(attachment.id);
                        var thumb = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                        container.append(
                            '<div class="sato-gallery-item" data-id="' + attachment.id + '">' +
                            '<img src="' + thumb + '" alt="">' +
                            '<button type="button" class="remove-image">&times;</button>' +
                            '</div>'
                        );
                    }
                });

                $('#works_gallery').val(ids.join(','));
            });
            frame.open();
        });

        // =============================================================================
        // Gallery Image Remover
        // =============================================================================
        $(document).on('click', '.sato-gallery-item .remove-image', function() {
            var item = $(this).closest('.sato-gallery-item');
            var id = item.data('id').toString();
            var ids = $('#works_gallery').val().split(',').filter(function(i) { return i !== id; });
            $('#works_gallery').val(ids.join(','));
            item.remove();
        });

        // =============================================================================
        // Gallery Sortable
        // =============================================================================
        if ($.fn.sortable) {
            $('#works_gallery_container').sortable({
                update: function() {
                    var ids = [];
                    $(this).find('.sato-gallery-item').each(function() {
                        ids.push($(this).data('id'));
                    });
                    $('#works_gallery').val(ids.join(','));
                }
            });
        }

        // =============================================================================
        // Star Rating Interaction
        // =============================================================================
        $('#rating-field label').on('click', function() {
            var index = $(this).index();
            $('#rating-field label').removeClass('star-checked');
            $('#rating-field label').slice(0, Math.floor(index / 2) + 1).addClass('star-checked');
        });

        // =============================================================================
        // SEO Character Counter
        // =============================================================================
        $('#sato_seo_title').on('input', function() {
            var len = $(this).val().length;
            $('#title-count').text(len);
            $('#title-count').parent().toggleClass('over', len > 60);
        });

        $('#sato_seo_description').on('input', function() {
            var len = $(this).val().length;
            $('#desc-count').text(len);
            $('#desc-count').parent().toggleClass('over', len > 160);
        });

    });

})(jQuery);
