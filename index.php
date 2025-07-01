<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revamp Your Rides - Đặt Lịch Hẹn</title>
    <link rel="stylesheet" href="Dat-lich/css/dat-lich.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>
  
    <div class="booking-container">
        <div class="info-side">
            <div class="logo-text">
                <h1>REVAMP</h1>
                <h1 class="yellow-text">YOUR</h1>
                <h1 class="yellow-text">RIDES</h1>
            </div>
            <div class="contact-info">
                <p>Để có những trải nghiệm tốt nhất khi đến với WrapStyle Việt Nam, bạn có thể đặt lịch trước theo form hoặc liên hệ qua số Hotline: <strong>+84 933 622 225</strong></p>
                <p>Hoặc liên hệ theo các thông tin bên dưới.</p>
            </div>
        </div>
        
        <div class="form-side">
            <h2>Book an appointment</h2>
            <div id="js-stripe-bar" class="stripe-bar"></div>
            <form action="#" method="POST">
                <div class="form-row">
                    <div class="form-group half-width">
                        <select id="title" name="title">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                        </select>
                    </div>
                    <div class="form-group half-width">
                        <input type="text" id="name" name="name" placeholder="Name*">
                    </div>
                </div>

                <div class="form-group">
                    <input type="tel" id="phone" name="phone" placeholder="Phone*">
                </div>

                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email*">
                </div>

                <div class="form-group">
                    <label class="services-label">SERVICES</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="services[]" value="wrapping"> WRAPPING</label>
                        <label><input type="checkbox" name="services[]" value="detailing"> DETAILING</label>
                        <label><input type="checkbox" name="services[]" value="ppf"> PPF</label>
                        <label><input type="checkbox" name="services[]" value="window_tinting"> WINDOW TINTING</label>
                        <label><input type="checkbox" name="services[]" value="others"> OTHERS</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="brand" class="inline-label">BRAND</label>
                        <select id="brand" name="brand">
                            <option value="Aston Martin">Aston Martin</option>
                            <option value="Bentley">Bentley</option>
                            <option value="BMW">BMW</option>
                            <option value="Ferrari">Ferrari</option>
                            <option value="Lamborghini">Lamborghini</option>
                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                            <option value="Porsche">Porsche</option>
                        </select>
                    </div>
                    <div class="form-group half-width">
                        <label for="schedule" class="inline-label">SCHEDULE</label>
                        <input type="date" id="schedule" name="schedule" placeholder="dd/mm/yyyy">
                    </div>
                </div>

                <div class="form-group">
                    <textarea id="message" name="message" rows="5" placeholder="Message"></textarea>
                </div>

                <div class="form-group">
                    <label class="terms-label">
                        <input type="checkbox" id="terms" name="terms" required>
                        I have read the "General Terms Of Use" and agree with it
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit">ĐẶT LỊCH HẸN</button>
                </div>
              
            </form>
               <script src="Dat-lich/js/dat-lich.js"></script>
        </div>
    </div>

</body>
</html>