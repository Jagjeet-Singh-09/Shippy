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
            max-width: 1300px;
            margin: auto;
        }
        .uploadbtn {
    background: #2563eb;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
}

        h1 {
            text-align: center;
            margin-bottom: 35px;
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .doc-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #1565ff;
            text-align: center;
        }

        .doc-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #ddd;
        }

        .doc-pdf {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 12px;
        }

        .info-box {
            margin-top: 18px;
            background: #f7f9ff;
            padding: 12px;
            border-radius: 10px;
        }

        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #222;
            word-break: break-word;
        }

        .status-box {
            margin-top: 18px;
            text-align: center;
        }

        .status-label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #444;
        }

        .status-value {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            text-transform: capitalize;
        }

        .pending {
            background: orange;
        }

        .approved {
            background: green;
        }

        .rejected {
            background: red;
        }

        .final-status-section,
        .remarks-section {
            margin-top: 40px;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .final-status-section h2,
        .remarks-section h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1565ff;
        }

        .final-status {
            text-align: center;
        }

        .remarks-box {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 12px;
            line-height: 1.7;
            color: #333;
            min-height: 120px;
        }

        @media(max-width:768px) {

            body {
                padding: 20px;
            }

            .doc-image,
            .doc-pdf {
                height: 300px;
            }

        }

    </style>

</head>

<body>

    <div class="container">

        <h1>Vendor Documents</h1>

        <div class="card">

                <button class="uploadbtn" onclick="uploadDocument()"> Upload button</button>

            <div class="card">

        <div class="document-grid">


            <!-- ========================= -->
            <!-- AADHAR -->
            <!-- ========================= -->
             

                <div class="doc-title">
                    Aadhar Card
                </div>

                <img
                    id="aadharImage"
                    class="doc-image"
                    src=""
                    alt="Aadhar Card">


                <!-- Aadhar Number -->
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


                <!-- Aadhar Status -->
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


                <!-- PAN Number -->
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


              

                <!-- PAN STATUS -->
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


                <!-- GST Number -->
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




                <!-- GST STATUS -->
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



        <!-- ========================= -->
        <!-- FINAL STATUS -->
        <!-- ========================= -->

        <div class="final-status-section">

            <h2>Final Vendor Status</h2>

            <div class="final-status">

                <div
                    id="finalStatus"
                    class="status-value pending">

                    pending

                </div>

            </div>

        </div>



        <!-- ========================= -->
        <!-- REMARKS -->
        <!-- ========================= -->

        <div class="remarks-section">

            <h2>Remarks From Admin</h2>

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