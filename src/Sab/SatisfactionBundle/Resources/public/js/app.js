function fillHumor()
{
    $("#sab_satisfactionbundle_stf_monthly_humor_4").prop("checked", true);
    $("#sab_satisfactionbundle_stf_monthly_humor").val(4);
    $("#account_resume_typeEquilibrium").val(1);
    $("#account_resume_mainIrritant").val("");
    $("#ac_maintIrritant_table").hide();

    $("#humorEquilibriumDialog").dialog(
            {
                resizable: false,
                height: 400,
                width: 450,
                modal: true,
                dialogClass: "validationDialog",
                buttons: {
                    "Envoyer": function () {
                        url = $('#submit-button').data('url');
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: $('#sab_satisfactionbundle_stf_monthly_humor').serialize(),
                            success: function (res) {
                                  console.log("ok");  
                            },
                            error: function (data) {
                                console.log(data);
                            },
                            complete: function () {
                                
                            }
                        })

                    },
                    "Annuler": function () {
                        $('#humorEquilibriumDialog').dialog("close");
                    }
                }
            });
}

$("#typeEquilibrium-selector").change(function () {
    $("#account_resume_typeEquilibrium").val($("#typeEquilibrium-selector").val());
});

$("#sab_satisfactionbundle_stf_monthly_humor_1").change(function () {
    if (this.checked) {
        $("#ac_maintIrritant_table").show();
        $("#sab_satisfactionbundle_stf_monthly_humor").val(this.value);
    }
});

$("#sab_satisfactionbundle_stf_monthly_humor_2").change(function () {
    if (this.checked) {
        $("#ac_maintIrritant_table").show();
        $("#sab_satisfactionbundle_stf_monthly_humor").val(this.value);
    }
});

$("#sab_satisfactionbundle_stf_monthly_humor_3").change(function () {
    if (this.checked) {
        $("#ac_maintIrritant_table").hide();
        $("#account_resume_mainIrritant").val("");
        $("#sab_satisfactionbundle_stf_monthly_humor").val(this.value);
    }
});

$("#sab_satisfactionbundle_stf_monthly_humor_4").change(function () {
    if (this.checked) {
        $("#ac_maintIrritant_table").hide();
        $("#account_resume_mainIrritant").val("");
        $("#sab_satisfactionbundle_stf_monthly_humor").val(this.value);
    }
});

$("#account_resume_mainIrritant_modal").keyup(function () {
    $("#account_resume_mainIrritant").val(this.value);
});
