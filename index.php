<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="header">
            <div style="padding-left: 0.5em;">
                <img src="./dashboard/assets/image/logo_2.png" alt="Doctor Inspiration" style="height:2rem;">
            </div>
            <div>
                <a style="text-decoration: none;" href="./dashboard/">
                    <h2 class="login">LOGIN</h2>
                </a>
            </div>
        </div>
        <div class="form-container">
            <form id="multi-section-form">
                <section class="form-section" id="section-1">
                    <div style="display: flex;justify-content: center;">
                        <h1 class="register-button">REGISTER NOW</h1>
                    </div>
                    <div style="margin-top:1.5em">
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="name">NAME:</label>
                                <input type="text" id="name" name="name">
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="address">ADDRESS:</label>
                                <input type="text" id="address" name="address">
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="year-of-completion">12TH YEAR OF COMPLETION:</label>
                                <input type="text" id="year-of-completion" name="year-of-completion">
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="total-marks">12TH TOTAL MARKS SCORED:</label>
                                <input type="text" id="total-marks" name="total-marks">
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="ilts-qualification">IELTS EXAM QUALIFICATION:</label>
                                <input type="text" id="ilts-qualification" name="ilts-qualification">
                            </div>
                        </div>
                    </div>
                    <div class="line-container">
                        <hr id="line-before" class="line">
                        <button type="button" onclick="nextSection(2)">NEXT</button>
                        <hr class="line">
                    </div>
                </section>
                <section class="form-section" id="section-2">
                    <button class="back-btn" style="cursor:pointer;width:auto;position: absolute;" type="button" onclick="prevSection(1)"><i class="fa-solid fa-rotate-left"></i></button>
                    <div style="margin-top: 1.5em;">
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="neet-year">NEET Qualification Year:</label>
                                <input type="text" id="neet-year" name="neet-year" required>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="neet-marks">NEET Total Marks Scored:</label>
                                <input type="text" id="neet-marks" name="neet-marks" required>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="mobile">Mobile No. :</label>
                                <input type="text" id="mobile" name="mobile" required>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <div class="form-group">
                                <label for="re-password">Re-enter Password:</label>
                                <input type="password" id="re-password" name="re-password" required>
                            </div>
                        </div>

                    </div>
                    <div class="line-container">
                        <hr id="line-before" class="line">
                        <button type="button" onclick="nextSection(3)">NEXT</button>
                        <hr class="line">
                    </div>
                </section>
                <section class="form-section" id="section-3">

                    <h2 class="upload-head" style="background-color: rgba(80, 167, 221, 1); text-align: center;padding: 0.5em 3em; border-radius: 25px;color:white;">DOCUMENT UPLOAD</h2>
                    <button class="back-btn" style="cursor:pointer;width:auto;position: absolute;" type="button" onclick="prevSection(2)"><i class="fa-solid fa-rotate-left"></i></button>
                    <div class="upload-div" style="display: flex;gap:2rem;justify-content: center;text-align: center; margin: 4em 0;">
                        <div class="upload">
                            <h1>HSC MARKSHEET.PDF</h1>
                            <div class="custom-file-upload">
                                <label for="fileInputHsc">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                            <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Click to upload file</span>
                                    </div>
                                    <input type="file" id="fileInputHsc" name="file" onchange="showFileName('fileInputHsc', 'fileNameHsc')">
                                </label>
                            </div>
                            <br>
                            <div id="fileNameHsc"></div>
                        </div>
                        <div class="upload">
                            <h1>NEET MARKSHEET.PDF</h1>
                            <div class="custom-file-upload">
                                <label for="fileInputNeet">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                            <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Click to upload file</span>
                                    </div>
                                    <input type="file" id="fileInputNeet" name="file" onchange="showFileName('fileInputNeet', 'fileNameNeet')">
                                </label>
                            </div>
                            <br>
                            <div id="fileNameNeet"></div>
                        </div>


                        <div class="upload">
                            <h1>PASSPORT.PDF</h1>
                            <div class="custom-file-upload">
                                <label for="fileInputPassport">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                            <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Click to upload file</span>
                                    </div>
                                    <input type="file" id="fileInputPassport" name="file" onchange="showFileName('fileInputPassport', 'fileNamePassport')">
                                </label>
                            </div>
                            <br>
                            <div id="fileNamePassport"></div>
                        </div>

                    </div>
                    <div class="line-container">
                        <hr id="line-before" class="line">
                        <button type="button" onclick="nextSection(4)">NEXT</button>
                        <hr class="line">
                    </div>
                </section>

                <script>
                    function showFileName(inputId, fileNameId) {
                        const fileInput = document.getElementById(inputId);
                        const fileNameDiv = document.getElementById(fileNameId);
                        if (fileInput.files.length > 0) {
                            fileNameDiv.textContent = 'Selected file: ' + fileInput.files[0].name;
                        } else {
                            fileNameDiv.textContent = 'No file selected';
                        }
                    }
                </script>

                <section class="form-section" id="section-4">
                    <button class="back-btn" style="cursor:pointer;width:auto;position: absolute;" type="button" onclick="prevSection(3)"><i class="fa-solid fa-rotate-left"></i></button>
                    <div class="fee-payment">
                        <h2 style="font-size:2.5rem;">FEE PAYMENT</h2>
                        <div class="fees">
                            <h2 style="color:white;padding-top: 20px;">FEES</h2>
                            <div style="margin: 0 2rem; margin-bottom: 20px;" class="fee-item">
                                <span>REGISTRATION FEES</span>
                                <span>₹10,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="line-container">
                        <hr class="line">
                        <button class="pay">PAY NOW
                        </button>
                        <hr class="line">
                    </div>
                </section>
            </form>
        </div>
    </div>

    <footer>
    </footer>
  <!-- Modal Structure -->
<!-- Modal Structure -->
<div id="custom-modal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <span class="custom-modal-close">&times;</span>
            <h5>Invitation Letter Payment</h5>
        </div>
        <div class="custom-modal-body">
            <h3>Invitation Letter Fee - 25,000 Rs</h3>
            <div class="mb-3 d-flex justify-content-center">
                <img src="./dashboard/assets/image/QR.jpg" alt="QR" height="300px">
            </div>
            <form id="payment-form">
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="Name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="Amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="Amount" name="amount" required>
                </div>
                <div class="mb-3">
                    <label for="Utr" class="form-label">UTR Number</label>
                    <input type="text" class="form-control" id="Utr" name="utr" required>
                </div>
                <div class="mb-3">
                    <label for="TDate" class="form-label">Transaction Date</label>
                    <input type="date" class="form-control" id="TDate" name="tdate" required>
                </div>
                <div class="mb-3">
                    <label for="Ttime" class="form-label">Transaction Time</label>
                    <input type="time" class="form-control" id="Ttime" name="ttime" required>
                </div>
                <div class="mb-3">
                    <label for="upi" class="form-label">Your UPI ID</label>
                    <input type="text" class="form-control" id="upi" name="upi" required>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label note">Note:</label>
                    <p class="form-note">Can only be paid once. Please be careful.</p>
                </div>
                <div class="custom-modal-footer">
                    <button type="button" class="custom-modal-btn custom-modal-cancel">Cancel</button>
                    <button type="submit" class="custom-modal-btn custom-modal-pay">Pay</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll(".form-section");
            sections.forEach((section) => section.classList.remove("active"));
            document.getElementById("section-" + sectionId).classList.add("active");
        }

        function nextSection(sectionId) {
            showSection(sectionId);
        }

        function prevSection(sectionId) {
            showSection(sectionId);
        }

        // Initially show the first section
        document.addEventListener("DOMContentLoaded", () => {
            showSection(1);
        });
    </script>

<script>
    // Get the modal
    const modal = document.getElementById("custom-modal");
    
    // Get the button that opens the modal
    const payNowBtn = document.querySelector(".pay");
    
    // Get the <span> element that closes the modal
    const closeBtn = document.querySelector(".custom-modal-close");
    
    // Get the cancel button
    const cancelBtn = document.querySelector(".custom-modal-cancel");
    
    // Open the modal
    payNowBtn.onclick = function() {
        modal.style.display = "block";
    }
    
    // Close the modal when the user clicks on <span> (x) or Cancel button
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }
    
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }
    
    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


</body>

</html>