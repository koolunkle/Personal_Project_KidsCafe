document.addEventListener("DOMContentLoaded", () => {
  const search = document.querySelector("#search");
  const root = document.querySelector("#root");
  const name_id = document.querySelector("#name_id");

  search.addEventListener("click", () => {
    if (name_id.value.trim().length === 0)
      location.replace("/project/service/service_notice.php?page=1");
    else
      location.replace(
        "/project/service/service_notice.php?page=1&search=" +
          root.value +
          "&name_id=" +
          name_id.value
      );
  });
});
