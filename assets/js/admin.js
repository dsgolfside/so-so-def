jQuery(document).ready(function($){
  $('.upload_slide_image').on('click', function(e){
    e.preventDefault();
    var targetField = $('#' + $(this).data('target'));
    var frame = wp.media({
      title: 'Select or Upload Slide Image',
      button: { text: 'Use this image' },
      multiple: false
    });
    frame.on('select', function(){
      var attachment = frame.state().get('selection').first().toJSON();
      targetField.val(attachment.url);
    });
    frame.open();
  });
});
