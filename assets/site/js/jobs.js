function search_jobs() {
  $.ajax({
    type: "POST",
    url: BASE_URL + "Search-Jobs",
    data: new FormData($("#searchForm")[0]),
    dataType: "HTML",
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (xhr) {
      $(".btn_submit").attr("disabled", true);
      $(".btn_submit").html(LOADING);
      // $("#responseMessage").html('');
      // $("#responseMessage").hide();
      $("#job-listings").html(LOADING);
    },
    success: function (response) {
      $(".btn_submit").prop("disabled", false);
      $(".btn_submit").html(" Search ");
      $("#job-listings").html(response);
    },
  });
}

function submit_form(e) {
  e.preventDefault();
  search_jobs();
}

search_jobs();
