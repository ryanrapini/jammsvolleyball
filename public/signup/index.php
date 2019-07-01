<!DOCTYPE html>
<html>

<head>
    <?php include('../../includes/head.php'); ?>
    <title>JAMMSVolleyball.com - Friday Schedule and Standings</title>
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
                        <h3 class="title is-3">Sign up to Play!</h3>
                    </div>

                    <div class="column is-12">
                        <div class="notification is-success" id="success-notification" style="display:none">
                          You have been registered successfully! You should receieve a follow-up email within 48 hours! Please remember to like our page on <a href="https://www.facebook.com/jammsvolleyball/">facebook</a> and tell your friends about our leagues!
                        </div>
                        <div class="notification is-warning" id="fail-notification" style="display:none">
                          Something went wrong while saving your registration. Your registration was not sent. Please contact <a href="mailto:ryanrapini@gmail.com">ryanrapini@gmail.com</a> for assistance.
                        </div>
                    </div>

                    <div class="column is-12">
                        <div class="columns">
                        <?php if(empty($_GET["type"])){ ?>
                            <div class="column is-12">
                                <div class="columns">
                                    <div class="column is-6">
                                        <h4 class="title is-4"><a class="button is-medium is-link" href="/signup?type=full">I have a Full Team</a></h4>
                                    </div>
                                    <div class="column is-6">
                                        <h4 class="title is-4"><a class="button is-medium is-link" href="/signup?type=individual">I'm an Individual Player</a></h4>
                                    </div>
                                </div>
                                <div class="column is-6 is-offset-3">
                                    <?php include('../../includes/leagues.php'); ?>
                                </div>
                            </div>
                        <?php } else if ($_GET["type"] === "full" || $_GET["type"] === "individual") { ?>
                            <div class="column is-4 is-offset-2">
                                <form action="#" method="post" class="js-form form">
                                    <?php if ($_GET["type"] === "full") { ?>
                            <h4 class="title is-4">Full Team Signup</h4>
                        <?php } ?>
                        <?php if ($_GET["type"] === "individual") { ?>
                            <h4 class="title is-4">Individual Player Signup</h4>
                        <?php } ?>
                                    <input type="hidden" id="formtype" name="formtype" value="<?php echo($_GET["type"]); ?>">
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
                                    <?php if ($_GET["type"] === "full") { ?>
                                    <div class="field">
                                        <label class="label">Team Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Team name here" data-validate-field="teamname" name="teamname" id="teamname">
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="field">
                                        <label class="label">Day of the Week</label>
                                        <div class="select">
                                          <select id="day_select" onchange="set_players()" data-validate-field="weekday" name="weekday">
                                            <option value="" selected disabled>Please Choose a Day</option>
                                            <option value="wed">Wednesday</option>
                                            <option value="fri">Friday</option>
                                            <option value="sun">Sunday</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Skill Level</label>
                                        <div class="select">
                                          <select name="skilllevel" data-validate-field="skilllevel">
                                            <option value="" selected disabled>Please Choose Skill Level</option>
                                            <option value="rec">Recreational</option>
                                            <option value="int">Intermediate</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Additional Notes</label>
                                        <div class="control">
                                            <textarea class="textarea" placeholder="Any additional questions or concerns here!" name="notes" id="notes"></textarea>
                                        </div>
                                    </div>

                                    <?php if ($_GET["type"] === "full") { ?>
                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input name="checkbox" type="checkbox" data-validate-field="checkbox">
                                                I have a full team of <span id="playercount">6</span> Players and I have read the <a href="/#rules" target="_blank">Rules</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="control">
                                        <button class="button is-link">Submit</button>
                                    </div>

                                </form>
                            </div>
                            <div class="column is-6">
                                <?php include('../../includes/leagues.php'); ?>
                                <?php if ($_GET["type"] === "full") { ?>
                                    <h4 class="title is-4"><a class="button is-medium is-link" href="/signup?type=individual">I'm an Individual Player Instead</a></h4>
                                <?php } ?>
                                <?php if ($_GET["type"] === "individual") { ?>
                                    <h4 class="title is-4"><a class="button is-medium is-link" href="/signup?type=full">I have a Full Team Instead</a></h4>
                                <?php } ?>
                            </div>
                        <?php } ?>
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
                    weekday: {
                        required: true,
                    },
                    skilllevel: {
                        required: true,
                    },
<?php if ($_GET["type"] === "full") { ?>
                    teamname: {
                        required: true,
                    },
                    checkbox: {
                        required: true
                    },
<?php } ?>
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