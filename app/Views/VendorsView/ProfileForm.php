<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Multi Step Form</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #1d4ed8;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button {
            padding: 12px 20px;
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .address-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div id="dynamicForm"></div>
    </div>

    <script>

        let id;


        $(document).ready(function () {

            $.ajax({

                url: "/api/renderForm",
                type: "GET",

                success: function (response) {

                    let step = response.message;
                    id = response.id;
                    
                    

                    renderStep(step);
                },

                error: function (xhr) {

                    console.log(xhr.responseText);
                }

            });

        });


        function renderStep(step) {

            let html = "";

            // STEP 1
            if (step == "step_oneView") {

                html += `

                <form autocomplete="off" id="step_oneForm">

                    <h2>Step One - Personal Details</h2>

                    <div id="step_oneMessage"></div>

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" autocomplete="off" required>
                    </div>

                    <button type="submit">Save & Continue</button>

                </form>
                `;
            }

            // STEP 2
            else if (step == "step_twoView") {

                html += `

                <form autocomplete="off" id="step_twoForm">

                    <h2>Step Two - Address Details</h2>

                    <div id="step_twoMessage"></div>

                    <div class="address-box">

                        <h3>Permanent Address</h3>

                        <div class="form-group">
                            <label>Permanent Address</label>

                            <textarea 
                                name="permanent_address" 
                                id="permanentAddress"
                                autocomplete="off"
                                required></textarea>
                            

                        </div>

                    </div>

                    <div class="address-box">

                        <h3>Shipping Address</h3>

                        <div class="form-group">

                            <input type="checkbox" id="sameAddress">

                            <label for="sameAddress">
                                Same as Permanent Address
                            </label>

                        </div>

                        <div class="form-group" id="shippingBox">

                            <label>Shipping Address</label>

                            <textarea 
                                name="shipping_address" 
                                id="shippingAddress"
                                autocomplete="off"
                                required></textarea>

                            
                        </div>

                    </div>

                    <button type="submit">Save & Continue</button>

                </form>
                `;
            }

            // STEP 3
            else if (step == "step_threeView") {

                html += `

                <form autocomplete="off" id="step_threeForm" enctype="multipart/form-data">

                    <h2>Step Three - Document Details</h2>

                    <div id="step_threeMessage"></div>

                    <div class="form-group">
                        <label>Aadhar Number</label>
                        <input type="text" name="aadhar_no" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Upload Aadhar</label>
                        <input type="file" name="aadhar_upload" required>
                    </div>

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text" name="pan_no" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Upload PAN</label>
                        <input type="file" name="pan_upload" required>
                    </div>

                    <div class="form-group">
                        <label>GST Number</label>
                        <input type="text" name="gst_no" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>Upload GST</label>
                        <input type="file" name="gst_upload" required>
                    </div>

                    <button type="submit">Submit</button>

                </form>
                `;
            }

            else if (step == "DashboardView") {

                window.location.href = "/VendorDashboard/" + id;
            }

            $("#dynamicForm").html(html);


            // SAME ADDRESS FUNCTIONALITY
            $("#sameAddress").change(function () {

                if ($(this).is(":checked")) {

                    let permanent = $("#permanentAddress").val();

                    $("#shippingAddress").val(permanent);

                    $("#shippingAddress").prop("required", false);

                    $("#shippingBox").hide();

                } else {

                    $("#shippingBox").show();

                    $("#shippingAddress").val("");

                    $("#shippingAddress").prop("required", true);
                }

            });

        }



        // STEP 1 SAVE
        $(document).on("submit", "#step_oneForm", function (e) {

            e.preventDefault();

            $.ajax({

                url: "/savestep_one",
                type: "POST",
                data: $(this).serialize(),

                success: function (response) {

                    $("#step_oneMessage").html(`
                        <div class="success-message">
                            ${response.message}
                        </div>
                    `);

                    setTimeout(() => {

                        renderStep("step_twoView");

                    }, 1000);

                },

                error: function (xhr) {

                    let response = JSON.parse(xhr.responseText);

                    $("#step_oneMessage").html(`
                        <div class="error-message">
                            ${response.message}
                        </div>
                    `);

                }

            });

        });



        // STEP 2 SAVE
        $(document).on("submit", "#step_twoForm", function (e) {

            e.preventDefault();

            $.ajax({

                url: "/savestep_two",
                type: "POST",
                data: $(this).serialize(),

                success: function (response) {

                    $("#step_twoMessage").html(`
                        <div class="success-message">
                            ${response.message}
                        </div>
                    `);

                    setTimeout(() => {

                        renderStep("step_threeView");

                    }, 1000);

                },

                error: function (xhr) {

                    let response = JSON.parse(xhr.responseText);

                    $("#step_twoMessage").html(`
                        <div class="error-message">
                            ${response.message}
                        </div>
                    `);

                }

            });

        });



        // STEP 3 SAVE
        $(document).on("submit", "#step_threeForm", function (e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: "/savestep_three",
                type: "POST",
                data: formData,

                processData: false,
                contentType: false,

                success: function (response) {

                    $("#step_threeMessage").html(`
                        <div class="success-message">
                            ${response.message}
                        </div>
                    `);

                    setTimeout(() => {

                        window.location.href = "/VendorDashboard/" + id;

                    }, 1000);

                },

                error: function (xhr) {

                    let response = JSON.parse(xhr.responseText);

                    $("#step_threeMessage").html(`
                        <div class="error-message">
                            ${response.message}
                        </div>
                    `);

                }

            });

        });

    </script>

</body>

</html>