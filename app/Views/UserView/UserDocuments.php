<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor Documents</title>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f7ff;
            padding: 40px;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #1565ff;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .doc-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }

        .doc-info {
            margin-bottom: 15px;
        }

        .doc-info p {
            margin-bottom: 8px;
            font-size: 15px;
            color: #444;
        }

        .doc-info span {
            font-weight: bold;
            color: #1565ff;
        }

        .doc-image {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #ddd;
        }

        .doc-pdf {
            width: 100%;
            height: 350px;
            border: none;
            border-radius: 12px;
        }

        .status-box {
            margin-top: 20px;
        }

        .status-box label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
        }

        .update-btn {
            margin-top: 15px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #1565ff;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .update-btn:hover {
            background: #0d47d9;
        }

        .message {
            margin-top: 12px;
            font-weight: bold;
            text-align: center;
        }

        .final-status-section {
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .final-status-section h2 {
            color: #1565ff;
            margin-bottom: 20px;
        }

        .final-status-badge {
            display: inline-block;
            padding: 14px 30px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .approved {
            background: #d4edda;
            color: #155724;
        }

        .rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .remarks-section {
            margin-top: 40px;
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .remarks-section h2 {
            margin-bottom: 15px;
            color: #1565ff;
        }

        .remarks-input {
            width: 100%;
            min-height: 140px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 12px;
            resize: vertical;
            font-size: 15px;
            outline: none;
        }

        .remarks-btn {
            margin-top: 15px;
            padding: 14px 25px;
            border: none;
            border-radius: 10px;
            background: #1565ff;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .remarks-btn:hover {
            background: #0d47d9;
        }

        .remarks-message {
            margin-top: 12px;
            font-weight: bold;
        }

        @media(max-width:768px) {

            body {
                padding: 20px;
            }

            .doc-image,
            .doc-pdf {
                height: 280px;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Vendor Documents</h1>

        <div class="document-grid">

            <!-- AADHAR CARD -->
            <div class="card">

                <div class="doc-title">Aadhar Card</div>

                <div class="doc-info">
                    <p>
                        Document Name :
                        <span>Aadhar Card</span>
                    </p>

                    <p>
                        Document Number :
                        <span id="aadharNumber"></span>
                    </p>

                    <p>
                        Document Status :
                        <span id="aadhar_card_status"></span>
                    </p>




                </div>

                <img
                    id="aadharImage"
                    class="doc-image"
                    src=""
                    alt="Aadhar Card">

                <div class="status-box">

                    <label>Aadhar Status</label>

                    <select id="aadharStatus">

                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>

                    </select>

                    <button
                        class="update-btn"
                        onclick="updateDocumentStatus('aadhar_card_status')">

                        Update Aadhar Status

                    </button>

                    <div
                        class="message"
                        id="aadharMessage">
                    </div>

                </div>

            </div>


            <!-- PAN CARD -->
            <div class="card">

                <div class="doc-title">PAN Card</div>

                <div class="doc-info">
                    <p>
                        Document Name :
                        <span>PAN Card</span>
                    </p>

                    <p>
                        Document Number :
                        <span id="panNumber"></span>
                    </p>

                    <p>
                        Document Status :
                        <span id="pan_card_status"></span>
                    </p>




                </div>

                <img
                    id="panImage"
                    class="doc-image"
                    src=""
                    alt="PAN Card">

                <div class="status-box">

                    <label>PAN Status</label>

                    <select id="panStatus">

                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>

                    </select>

                    <button
                        class="update-btn"
                        onclick="updateDocumentStatus('pan_card_status')">

                        Update PAN Status

                    </button>

                    <div
                        class="message"
                        id="panMessage">
                    </div>

                </div>

            </div>


            <!-- GST -->
            <div class="card">

                <div class="doc-title">GST File</div>

                <div class="doc-info">
                    <p>
                        Document Name :
                        <span>GST Certificate</span>
                    </p>

                    <p>
                        GST Number :
                        <span id="gstNumber"></span>
                    </p>
                    <p>
                        Document Status :
                        <span id="gst_status"></span>
                    </p>



                </div>

                <iframe
                    id="gstPdf"
                    class="doc-pdf"
                    src="">
                </iframe>

                <div class="status-box">

                    <label>GST Status</label>

                    <select id="gstStatus">

                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>

                    </select>

                    <button
                        class="update-btn"
                        onclick="updateDocumentStatus('gst_status')">

                        Update GST Status

                    </button>

                    <div
                        class="message"
                        id="gstMessage">
                    </div>

                </div>

            </div>
            <div class="remarks-section">

                <h2>Remarks</h2>

                <textarea
                    id="remarks"
                    class="remarks-input"
                    placeholder="Enter remarks here..."></textarea>

                <button
                    class="remarks-btn"
                    onclick="submitRemarks()">

                    Submit Remarks

                </button>

                <div
                    class="remarks-message"
                    id="remarksMessage">
                </div>

                <div
                    class="remarks-message">
                    <p >Previous Remarks : <span id="remarksMsg"></span></p>
                </div>

            </div>

        </div>


        <!-- FINAL STATUS -->
        <div class="final-status-section">

            <h2>Final Vendor Status</h2>

            <div
                id="finalStatus"
                class="final-status-badge pending">

                Pending

            </div>

        </div>

    </div>

    <script>
        // VENDOR ID FROM URL
        let vendorId = window.location.pathname.split("/").pop();


        // LOAD DOCUMENTS
        function loadDocuments() {

            $.ajax({

                url: "/api/vendor-documents/" + vendorId,

                type: "GET",

                success: function(response) {

                    // =========================
                    // AADHAR
                    // =========================

                    $("#aadharImage").attr(
                        "src",
                        response.aadhar_card_path
                    );

                    $("#aadharNumber").html(
                        response.aadhar_card
                    );
                    $("#aadhar_card_status").html(
                        response.aadhar_card_status
                    );

                    $("#aadharStatus").val(
                        response.aadhar_card_status
                    );


                    // =========================
                    // PAN
                    // =========================

                    $("#panImage").attr(
                        "src",
                        response.pan_card_path
                    );

                    $("#panNumber").html(
                        response.pan_card
                    );
                    $("#pan_card_status").html(
                        response.pan_card_status
                    );

                    $("#panStatus").val(
                        response.pan_card_status
                    );


                    // =========================
                    // GST
                    // =========================

                    $("#gstPdf").attr(
                        "src",
                        response.gst_path
                    );

                    $("#gstNumber").html(
                        response.gst_number
                    );
                    $("#gst_status").html(
                        response.gst_status
                    );

                    $("#gstStatus").val(
                        response.gst_status
                    );

                    $("#remarksMsg").html(response.remarks);


                    // =========================
                    // FINAL STATUS
                    // =========================

                    $("#finalStatus")
                        .removeClass(
                            "pending approved rejected"
                        )
                        .addClass(response.final_status)
                        .html(response.final_status);

                },

                error: function(xhr) {

                    console.log(xhr);

                    alert("Failed to load documents");

                }

            });

        }

        function submitRemarks() {

    let remarks = $("#remarks").val();

    $.ajax({

        url: "/api/update-remarks/" + vendorId,

        type: "POST",

        data: {

            remarks: remarks

        },

        success: function(response) {

            $("#remarksMessage")
                .css("color", "green")
                .html("Remarks Updated Successfully");

        },

        error: function(xhr) {

            $("#remarksMessage")
                .css("color", "red")
                .html("Failed To Update Remarks");

        }

    });

}


        // UPDATE DOCUMENT STATUS
        function updateDocumentStatus(type) {;

            let status = "";

            if (type == "aadhar_card_status") {

                status = $("#aadharStatus").val();

            } else if (type == "pan_card_status") {

                status = $("#panStatus").val();

            } else if (type == "gst_status") {

                status = $("#gstStatus").val();

            }


            $.ajax({

                url: "/api/update-vendor-status/" + vendorId,

                type: "POST",

                data: {

                    type: type,
                    status: status

                },

                success: function(response) {

                    $("#" + type + "Message")
                        .css("color", "green")
                        .html(
                            type.toUpperCase() +
                            " Status Updated Successfully"
                        );

                    // RELOAD DOCUMENTS
                    loadDocuments();

                },

                error: function(xhr) {

                    $("#" + type + "Message")
                        .css("color", "red")
                        .html(
                            "Failed to update status"
                        );

                }

            });

        }


        // INITIAL LOAD
        loadDocuments();
    </script>

</body>

</html>