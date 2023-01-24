const error = null;
const server_error = null;
const handleSubmit = (event) => {
    event.preventDefault();
    console.log('submit');
    $(".container-box").loading({ message: "Event loading..." });
    const formData = new FormData(document.getElementById("form"));
    if (formData) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/api/event/create",
            headers: { Accept: "application/json" },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log('res',res);
                $(".container-box").loading("stop");
                const message = res.message;
                Toast.fire({
                    icon: "success",
                    title: message,
                });
            },
            error: function (error) {
                $(".container-box").loading("stop");
                if (error.status === 422) {
                    this.server_error = $.parseJSON(
                        error.responseText
                    ).errors.email;
                    Toast.fire({
                        icon: "error",
                        title: this.server_error,
                    });
                }
            },
        });
    }
};
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
let editEvent = (data)=>{
    console.log('edie');
    console.log(data);
}
let validation = (value, name) => {
    if (name == "email") {
        if (!value) {
            $(".button").prop("disabled", true);
            return "Email is required";
        } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(value)) {
            $(".button").prop("disabled", true);
            return "Email Format is required";
        }
        $(".button").prop("disabled", false);
        return "";
    }
};
const handleBlur = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    this.error = validation(value, name);
    $(".error").text(this.error);
    this.error
        ? $(".email").addClass("is-invalid")
        : $(".email").removeClass("is-invalid");
};
const hanleKeydown = (event) => {
    if (event.target.name == "email") {
        if (!event.target.value) {
            $(".button").prop("disabled", true);
            return;
        } else if (
            !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(
                event.target.value
            )
        ) {
            $(".button").prop("disabled", true);
            return;
        }
        $(".button").prop("disabled", false);
    }
    $(".error").empty();
    $(".email").removeClass("is-invalid");
};