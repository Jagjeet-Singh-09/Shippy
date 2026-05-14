<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor Documents</title>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background:
                linear-gradient(135deg, #eef4ff 0%, #f8fbff 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 38px;
            font-weight: 700;
            color: #1565ff;
        }

        .uploadbtn {
            background: linear-gradient(135deg, #1565ff, #0d47c7);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 10px 20px rgba(21, 101, 255, 0.25);
        }

        .uploadbtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(21, 101, 255, 0.35);
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 30px;
        }

        .card {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.06);
            transition: 0.3s ease;
            border: 1px solid #edf2ff;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .doc-title {
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #1565ff;
            margin-bottom: 22px;
        }

        .doc-image,
        .doc-pdf {
            width: 100%;
            height: 420px;
            border-radius: 18px;
            border: 1px solid #dce5ff;
            background: #f7f9ff;
        }

        .doc-image {
            object-fit: cover;
        }

        .doc-pdf {
            overflow: hidden;
        }

        .info-box {
            margin-top: 20px;
            padding: 16px;
            background: #f7f9ff;
            border-radius: 14px;
            border: 1px solid #e5edff;
        }

        .info-label {
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 17px;
            font-weight: 600;
            color: #111827;
            word-break: break-word;
        }

        .status-box {
            margin-top: 22px;
            text-align: center;
        }

        .status-label {
            margin-bottom: 12px;
            color: #4b5563;
            font-weight: 600;
            font-size: 14px;
        }

        .status-value {
            display: inline-block;
            min-width: 130px;
            padding: 12px 24px;
            border-radius: 40px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.5px;
        }

        .pending {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .approved {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .rejected {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .final-status-section,
        .remarks-section {
            margin-top: 40px;
            background: white;
            border-radius: 24px;
            padding: 35px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #edf2ff;
        }

        .section-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #1565ff;
            margin-bottom: 25px;
        }

        .final-status {
            text-align: center;
        }

        .remarks-box {
            background: #f8faff;
            border-radius: 18px;
            padding: 24px;
            line-height: 1.9;
            color: #374151;
            font-size: 16px;
            border: 1px solid #e5edff;
            min-height: 140px;
        }

        @media(max-width: 768px) {

            body {
                padding: 20px 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .page-title {
                font-size: 30px;
                text-align: center;
            }

            .uploadbtn {
                width: 100%;
            }

            .document-grid {
                grid-template-columns: 1fr;
            }

            .doc-image,
            .doc-pdf {
                height: 300px;
            }

            .final-status-section,
            .remarks-section {
                padding: 24px;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="page-header">

            <div class="page-title">
                Vendor Documents
            </div>

            <button class="uploadbtn" onclick="uploadDocument()">
                Upload Document
            </button>

        </div>

        <!-- DOCUMENT GRID -->
        <div class="document-grid">

            <!-- ========================= -->
            <!-- AADHAR -->
            <!-- ========================= -->

            <div class="card">

                <div class="doc-title">
                    Aadhar Card
                </div>

                <img
                    id="aadharImage"
                    class="doc-image"
                    src=""
                    alt="Aadhar Card">

                <div class="info-box">

                    <div class="info-label">
                        Aadhar Number
                    </div>

                    <div
                        class="info-value"
                        id="aadharNumber">

                        -

                    </div>

                </div>

                <div class="status-box">

                    <div class="status-label">
                        Document Status
                    </div>

                    <div
                        id="aadharStatus"
                        class="status-value pending">

                        pending

                    </div>

                </div>

            </div>

            <!-- ========================= -->
            <!-- PAN -->
            <!-- ========================= -->

            <div class="card">

                <div class="doc-title">
                    PAN Card
                </div>

                <img
                    id="panImage"
                    class="doc-image"
                    src=""
                    alt="PAN Card">

                <div class="info-box">

                    <div class="info-label">
                        PAN Number
                    </div>

                    <div
                        class="info-value"
                        id="panNumber">

                        -

                    </div>

                </div>

                <div class="status-box">

                    <div class="status-label">
                        Document Status
                    </div>

                    <div
                        id="panStatus"
                        class="status-value pending">

                        pending

                    </div>

                </div>

            </div>

            <!-- ========================= -->
            <!-- GST -->
            <!-- ========================= -->

            <div class="card">

                <div class="doc-title">
                    GST Document
                </div>

                <iframe
                    id="gstPdf"
                    class="doc-pdf"
                    src="">
                </iframe>

                <div class="info-box">

                    <div class="info-label">
                        GST Number
                    </div>

                    <div
                        class="info-value"
                        id="gstNumber">

                        -

                    </div>

                </div>

                <div class="status-box">

                    <div class="status-label">
                        Document Status
                    </div>

                    <div
                        id="gstStatus"
                        class="status-value pending">

                        pending

                    </div>

                </div>

            </div>

        </div>

        <!-- FINAL STATUS -->

        <div class="final-status-section">

            <div class="section-title">
                Final Vendor Status
            </div>

            <div class="final-status">

                <div
                    id="finalStatus"
                    class="status-value pending">

                    pending

                </div>

            </div>

        </div>

        <!-- REMARKS -->

        <div class="remarks-section">

            <div class="section-title">
                Remarks From Admin
            </div>

            <div
                class="remarks-box"
                id="remarks">

                No remarks available.

            </div>

        </div>

    </div>

    <script>

        // GET VENDOR ID FROM URL
        let vendorId = window.location.pathname.split("/").pop();

        console.log(vendorId);

        // SET STATUS CLASS
        function setStatusClass(elementId, status) {

            status = status || "pending";

            $("#" + elementId)
                .removeClass("pending approved rejected")
                .addClass(status.toLowerCase())
                .html(status);

        }

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

                    setStatusClass(
                        "aadharStatus",
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

                    setStatusClass(
                        "panStatus",
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

                    setStatusClass(
                        "gstStatus",
                        response.gst_status
                    );

                    // =========================
                    // FINAL STATUS
                    // =========================

                    setStatusClass(
                        "finalStatus",
                        response.final_status
                    );

                    // =========================
                    // REMARKS
                    // =========================

                    $("#remarks").html(

                        response.remarks
                        ? response.remarks
                        : "No remarks available."

                    );

                },

                error: function(xhr) {

                    console.log(xhr);

                    alert("Failed to load vendor documents");

                }

            });

        }

        // UPLOAD DOCUMENT
        function uploadDocument() {

            $.ajax({

                url: "/api/vendor/stepUpdate/",

                type: "POST",

                success: function(response) {

                    alert("Document uploaded successfully!");

                    window.location.href = "/profileCreation";

                },

                error: function(xhr) {

                    console.log(xhr);

                    alert("Failed to upload document");

                }

            });

        }

        // INITIAL LOAD
        loadDocuments();

    </script>

</body>

</html>