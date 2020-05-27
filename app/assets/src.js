$(document).ready(function() {
  $('.btn-change-status').on('click', function() {
    $.ajax({
      url: 'change-status.php',
      method: 'post',
      data: 'comment_id=1&user=vasya',
      cache: false,
      success: function(arrText, comment_id) {
        $('#user-comment_status-'+comment_id).text(arrText[0]);
        $('#comment-'+comment_id+'_status-button-text').text(arrText[1]);
      }
    });
  })
})