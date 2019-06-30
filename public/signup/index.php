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
                        <?php } else if ($_GET["type"] === "full") { ?>
                            <div class="column is-4 is-offset-2">
                                <form>
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Your name here">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input class="input" type="email" placeholder="Your email address here">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Phone Number</label>
                                        <div class="control">
                                            <input class="input" type="phone" placeholder="Your phone number here">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Team Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Team name here">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Day of the Week</label>
                                        <div class="select">
                                          <select>
                                            <option>Wednesday</option>
                                            <option>Friday</option>
                                            <option>Sunday</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Skill Level</label>
                                        <div class="select">
                                          <select>
                                            <option>Recreational</option>
                                            <option>Intermediate</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Additional Notes</label>
                                        <div class="control">
                                            <textarea class="textarea" placeholder="Any additional questions or concerns here!"></textarea>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input type="checkbox">
                                                I have a full team of <span id="playercount"></span> Players and I have read the <a href="/#rules" target="_blank">Rules</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control">
                                        <button class="button is-link">Submit</button>
                                    </div>

                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="column is-4 is-offset-2">
                                <form>
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Your name here">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input class="input" type="email" placeholder="Your email address here">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Phone Number</label>
                                        <div class="control">
                                            <input class="input" type="phone" placeholder="Your phone number here">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Day of the Week</label>
                                        <div class="select">
                                          <select>
                                            <option>Wednesday</option>
                                            <option>Friday</option>
                                            <option>Sunday</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Skill Level</label>
                                        <div class="select">
                                          <select>
                                            <option>Recreational</option>
                                            <option>Intermediate</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Additional Notes</label>
                                        <div class="control">
                                            <textarea class="textarea" placeholder="Any additional questions or concerns here!"></textarea>
                                        </div>
                                    </div>
                                    <div class="control">
                                        <button class="button is-link">Submit</button>
                                    </div>

                                </form>
                            </div>
                        <?php } ?>
                            <div class="column is-6">
                                <?php include('../../includes/leagues.php'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="column is-12">
                        <h5 class="title is-5"><a href="/">Return Home</a></h5>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../../includes/footer.php'); ?>
    </section>
</body>

</html>