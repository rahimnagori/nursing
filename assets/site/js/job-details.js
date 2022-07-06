function apply() {
  $.ajax({
    type: "POST",
    url: BASE_URL + "Apply",
    data: {
      id: $("#job_id").val(),
    },
    dataType: "json",
    beforeSend: function (xhr) {
      $(".btn_submit").attr("disabled", true);
      $(".btn_submit").html(LOADING);
      $("#responseMessage").hide();
    },
    success: function (response) {
      $("#responseMessage").html(response.responseMessage);
      $("#responseMessage").show();
      if (response.status == 1) {
        $(".btn_submit").html(" Applied ");
      } else if (response.status == 3) {
        $(".btn_submit").html(" Already applied ");
      } else {
        $(".btn_submit").html(" Apply ");
        $(".btn_submit").prop("disabled", false);
      }
    },
  });
}

function apply_as_guest(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: BASE_URL + "Apply-Guest",
    data: new FormData($("#guestApplicationForm")[0]),
    dataType: "JSON",
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (xhr) {
      $(".btn_submit_apply").attr("disabled", true);
      $(".btn_submit_apply").html(LOADING);
      $("#responseMessageSecond").hide();
    },
    success: function (response) {
      $(".btn_submit_apply").attr("disabled", false);
      $(".btn_submit_apply").html("Apply");
      $("#responseMessageSecond").html(response.responseMessage);
      $("#responseMessageSecond").show();
      if (response.status == 1) {
        $(".btn_submit_apply").html("Applied");
        /* Reset the form here */
      }
    },
  });
}
