<?= $this->extend('Layouts\login_layout.php') ?>
<?= $this->section('content') ?>
<html lang="en" dir="ltr">

<body>
    <main class="main-content">
        <?= form_open(base_url('/verify')) ?>
        <div class="admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                        <div class="edit-profile">
                            <?php
                            if (session()->getFlashdata('message') != null) {
                            ?> <div class=" alert alert-success  alert-dismissible fade show " role="alert">
                                    <div class="alert-content">
                                        <p><?php
                                            echo session()->getFlashdata('message');
                                            ?></p>
                                        <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                                            <img src="<?= base_url('resources/img/svg/x.svg') ?>" alt="x" class="svg" aria-hidden="true">
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="edit-profile__logos">
                                <a href="<?= base_url("/") ?>">
                                    <img class="dark" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="">
                                    <img class="light" src="<?= base_url('resources/img/Hex_ecommerce_logo.png') ?>" alt="">
                                </a>
                            </div>
                            <div class="card border-0">
                                <div class="card-header">
                                    <div class="edit-profile__title">
                                        <h6>Otp Verification</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="edit-profile__body">
                                        <div class="form-group mb-25">
                                            <label for="otp">OTP</label>
                                            <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP">
                                            <span class="help-block"><?= $validation->showError('otp') ?></span>
                                            <div><span id="timerText">Resend OTP in </span><span id="timer">2:00</span></div>
                                            <input type="hidden" class="form-control" id="uid" name="uid" value="<?= $uid ?>">
                                            <input type="hidden" class="form-control" id="isSetNewPass" name="isSetNewPass" value="<?= isset($isSetNewPass) ? $isSetNewPass : false ?>">
                                        </div>
                                        <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                            <button class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn" name="verify">
                                                Verify
                                            </button>
                                            <button id="resend" class="btn btn-warning btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn" name="resend">
                                                Resend OTP
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- End: .card-body -->
                            </div><!-- End: .card -->
                        </div><!-- End: .edit-profile -->
                    </div><!-- End: .col-xl-5 -->
                </div>
            </div>
        </div><!-- End: .admin-element  -->
        <?= form_close() ?>
    </main>
    <div id="overlayer">
        <div class="loader-overlay">
            <div class="dm-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </div>
    </div>
    <div class="enable-dark-mode dark-trigger">
        <ul>
            <li>
                <a href="#">
                    <i class="uil uil-moon"></i>
                </a>
            </li>
        </ul>
    </div>
    <script>
        // Set the target time to 2 minutes (2 minutes * 60 seconds)
        const targetTime = new Date().getTime() + (2 * 60 * 1000);

        // Update the timer every second
        let timerInterval;

        // Start the timer when the page loads
        startTimer();

        function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            document.getElementById("timer").innerText = "";
            document.getElementById("timerText").innerText = "";
            document.getElementById("resend").disabled = false;
        }

        function updateTimer() {
            // Get the current time
            const currentTime = new Date().getTime();

            // Calculate the remaining time
            const remainingTime = targetTime - currentTime;

            // Convert remaining time to minutes and seconds
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            // Display the remaining time
            document.getElementById("timer").innerText = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            // If the countdown is finished, display "Time's up!" and stop the timer
            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                document.getElementById("timer").innerText = "";
                document.getElementById("timerText").innerText = "";
                document.getElementById("resend").disabled = false;
            }
        }

        // Handle validation errors from CodeIgniter
        <?php if (isset($validation) && $validation->hasError('otp')) { ?>
            stopTimer();
        <?php } ?>
    </script>

</body>

</html>
<?= $this->endSection('content') ?>