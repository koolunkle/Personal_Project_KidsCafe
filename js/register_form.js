function check_form() {
  if (!document.register_form.id.value) {
    alert("please enter your id");
    document.register_form.id.focus();
    return;
  }

  if (!document.register_form.password.value) {
    alert("please enter your password");
    document.register_form.password.focus();
    return;
  }

  if (!document.register_form.password_confirm.value) {
    alert("please enter your password confirm");
    document.register_form.password_confirm.focus();
    return;
  }

  if (!document.register_form.name.value) {
    alert("please enter your name");
    document.register_form.name.focus();
    return;
  }

  if (!document.register_form.email.value) {
    alert("please enter your email");
    document.register_form.email.focus();
    return;
  }

  if (
    document.register_form.password.value !=
    document.register_form.password_confirm.value
  ) {
    alert("password does not match\nplease re-enter");
    document.register_form.password.focus();
    document.register_form.password.select();
    return;
  }

  document.register_form.submit();
}

function reset_form() {
  document.register_form.id.value = "";
  document.register_form.password.value = "";
  document.register_form.password_confirm.value = "";
  document.register_form.name.value = "";
  document.register_form.email.value = "";
  document.register_form.id.focus();
  return;
}

function check_id() {
  window.open(
    "register_check_id.php?id=" + document.register_form.id.value,
    "IDcheck",
    "left = 700, top = 300, width = 350, height = 200, scrollbars=  no, resizable = yes, status = no, titlebar = no, toolbar = no, location = no, menubar = no"
  );
}
