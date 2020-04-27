<!DOCTYPE html>
<html>

<head>
    <?php include('../../includes/head.php'); ?>
    <title>JAMMSVolleyball.com - Sign Up to Play!</title>
</head>

<body>
    <section class="hero is-fullheight is-default is-bold">
        <div class="hero-head">
            <?php include('../../includes/nav.php'); ?>
        </div>
        <div class="hero-body">

            <div class="container has-text-centered">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <h5 class="title is-5"><a href="/">Return Home</a></h5>
                    </div>

                    <div class="column is-12">
                        <h3 class="title is-3">Registration is closed!</h3>
                    </div>

                    <div class="column is-12">
                        <div class="notification is-success" id="success-notification" style="display:none">
                          You have been added successfully! You should receieve a follow-up email within 48 hours! Please remember to like our page on <a href="https://www.facebook.com/jammsvolleyball/">facebook</a> and tell your friends about our leagues!
                        </div>
                        <div class="notification is-warning" id="fail-notification" style="display:none">
                          Something went wrong while saving your registration. Your registration was not sent. Please contact <a href="mailto:ryanrapini@gmail.com">ryanrapini@gmail.com</a> for assistance.
                        </div>
                    </div>

                    <div class="column is-12">
                    	<div class="is-size-5"> Sadly, JAMMS has closed. At this point it is unlikely that leagues will be offered this summer. If the next owner is interested, I would like to continue running leagues at this location.</div>

                    	<div class="is-size-5">If you would like to be notified of any future volleyball, please fill out the form below and I will notify you when I know more.</div>
                    </div>

                    <div class="column is-12">
                        <div class="columns is-centered">
                            <div class="column is-half-desktop">
                                <form action="#" method="post" class="js-form form">
                                	<div class="field">
                                        <label class="label">Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Your name here" data-validate-field="name" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input class="input" type="email" placeholder="Your email address here" data-validate-field="email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Phone Number (include area code)</label>
                                        <div class="control">
                                            <input class="input" type="phone" placeholder="Your phone number here" data-validate-field="phone" name="phone" id="phone">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Skill Level</label>
                                        <div class="select">
                                          <select name="skilllevel" data-validate-field="skilllevel">
                                            <option value="" selected disabled>Please Estimate your Skill Level</option>
                                            <option value="rec">Recreational</option>
                                            <option value="int">Intermediate</option>
                                            <option value="adv">Advanced</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Contact Me About:</label>
                                        <label class="checkbox">
											<input type="checkbox" name="interest_leagues" value="league">
											Upcoming Leagues
										</label>
                                        <br>
                                        <label class="checkbox">
											<input type="checkbox" name="interest_tournament" value="tournament">
											Upcoming Tournaments
										</label>
                                        <br>
                                        <label class="checkbox">
											<input type="checkbox" name="interest_sub" value="sub">
											When subs are needed
										</label>
                                    </div>
                                    <div class="control is-vcentered">
                                        <button class="button is-link">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="column is-12">
                        <h5 class="title is-5"><a href="/">Return Home</a></h5>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function set_players() {
                var weekday_select = document.getElementById("day_select");
                var weekday = weekday_select.options[weekday_select.selectedIndex].value;
                var players = 6;
                if(weekday === "fri"){
                    players = 4;
                }
                document.getElementById("playercount").textContent=players;

            }

            new window.JustValidate('.js-form', {
                rules: {
                    phone: {
                        required: true,
                        phone: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required: true,
                    },
                    skilllevel: {
                        required: true,
                    },
                },
                messages: {
                    phone: {
                        phone: 'Enter a valid phone number (10 digits).'
                    },
                },
                submitHandler: function (form, values, ajax) {
                    ajax({
                        url: '/signup/submit.php',
                        method: 'POST',
                        data: values,
                        async: true,
                        callback: function(response)  {
                            scroll(0,0);
                            if (response == "true"){
                                document.getElementById("success-notification").style.display = "block";
                            }
                            else {
                                console.log(response);
                                document.getElementById("fail-notification").style.display = "block";
                            }
                        }
                    });
                },
            });
        </script>


        <?php include('../../includes/footer.php'); ?>
    </section>
</body>

</html>