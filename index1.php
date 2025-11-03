<!DOCTYPE html>
<html>
<head>
    <title>Send Message</title>
</head>
<body>
    <div class="registerarea sp_top_90">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="registerarea__wraper">
                        <div class="registerarea__content">
                            <div class="registerarea__video">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                    <div class="registerarea__form">
                        <div class="registerarea__form__heading">
                            <h4>Fill Your Registration</h4>
                        </div>
                        <form action="Api/send-mail.php" method="post">
                            <input class="register__input" type="text" placeholder="Your Name" name="name" required="">
                            <div class="row">
                                <div class="col-xl-12">
                                    <input class="register__input" type="text" placeholder="Email Address" name="email"
                                        required>
                                </div>
                                <div class="col-xl-12">
                                    <input class="register__input" type="text" placeholder="Phone" name="phone">
                                </div>
                            </div>
                            <textarea class="register__input textarea" name="comment" id="#" cols="30" rows="10"
                                placeholder="comment"></textarea>
                            <div class="registerarea__button">
                                <button class="btn default__button" name="submit" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>