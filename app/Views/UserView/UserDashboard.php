<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor List</title>

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
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #1565ff;
        }

        .table-container {
            background: white;
            border-radius: 16px;
            overflow-x: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #1565ff;
            color: white;
        }

        th,
        td {
            padding: 16px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        .view-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            background: #1565ff;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .view-btn:hover {
            background: #0d47d9;
        }

        .status {
            font-weight: bold;
        }

        .approved {
            color: green;
        }

        .pending {
            color: orange;
        }

        .rejected {
            color: red;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            gap: 10px;
        }

        .pagination button {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            background: #1565ff;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .pagination button:hover {
            background: #0d47d9;
        }

        .pagination button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        @media(max-width:768px) {

            body {
                padding: 20px;
            }

            th,
            td {
                padding: 12px;
                font-size: 14px;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Vendor List</h1>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>User ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Documents</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody id="vendorTableBody">

                    <!-- AJAX DATA -->

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="pagination">

            <button id="prevBtn">Previous</button>

            <button id="nextBtn">Next</button>

        </div>

    </div>

    <script>
        let currentPage = 1;

        let limit = 10;


        // LOAD DATA
        function loadVendors(page) {

            $.ajax({

                url: "/api/getVendorDocs",

                type: "GET",

                data: {

                    page: page,

                    limit: limit

                },

                success: function(response) {

                    let vendors = response.data;

                    let html = "";


                    if (vendors.length === 0) {

                        html += `
                        
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>

                        `;

                    } else {

                        vendors.forEach(function(vendor) {

                            let statusClass = "";

                            if (vendor.status === "Approved") {

                                statusClass = "approved";

                            } else if (vendor.status === "Pending") {

                                statusClass = "pending";

                            } else {

                                statusClass = "rejected";
                            }


                            html += `

                                <tr>

                                    <td>${vendor.vendor_id}</td>

                                    <td>${vendor.first_name} ${vendor.last_name} </td>

                                    <td>${vendor.email}</td>

                                    <td>

    <button 
        class="view-btn"
        onclick="viewDocuments(${vendor.vendor_id})">

        View Documents

    </button>

</td>

                                    <td class="status ${statusClass}">
                                        ${vendor.final_status}
                                    </td>

                                </tr>

                            `;
                        });

                    }


                    $("#vendorTableBody").html(html);


                    // PAGINATION BUTTONS
                    $("#prevBtn").prop("disabled", currentPage === 1);

                    $("#nextBtn").prop("disabled", vendors.length < limit);

                },

                error: function(xhr) {

                    console.log(xhr);

                    alert("Failed to load vendors");

                }

            });

        }


        // VIEW DOCUMENTS
        function viewDocuments(userId) {

            window.location.href = "/vendor-documents/" + userId;

        }


        // NEXT BUTTON
        $("#nextBtn").click(function() {

            currentPage++;

            loadVendors(currentPage);

        });


        // PREVIOUS BUTTON
        $("#prevBtn").click(function() {

            if (currentPage > 1) {

                currentPage--;

                loadVendors(currentPage);
            }

        });


        // INITIAL LOAD
        loadVendors(currentPage);

        function viewDocuments(userId) {

            window.location.href = "/vendor-documents/" + userId;

        }
    </script>

</body>

</html>