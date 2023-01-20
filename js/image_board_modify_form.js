function check_form() {
  if (!document.image_board_form.subject.value) {
    alert("please enter your title");
    document.image_board_form.subject.focus();
    return;
  }

  if (!document.image_board_form.content.value) {
    alert("please enter your content");
    document.image_board_form.content.focus();
    return;
  }

  document.image_board_form.submit();
}
