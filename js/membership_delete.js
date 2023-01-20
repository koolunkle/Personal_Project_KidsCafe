function set_membership_delete() {
  let submit = document.querySelector("#submit");
  submit.addEventListener("click", () => {
    if (confirm("all info will be lost, would you like to withdraw?"))
      location.replace("/project/membership/membership_delete_server.php");
  });
}
