<section class="banner" id="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="logo">
                    <img src="<?= base_url() ?>public/asset/front/img/logo.png" alt="Flight Template">
                </div>
            </div>
            <div class="col-md-6 col-md-offset-6">
                <section id="first-tab-group" class="tabgroup">
                    <div id="tab1">
                        <div class="submit-form">
                            <h4>Login Here</h4>
                            <form id="form-submit" action="" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-md-2 col-md-offset-2" for="from">Username </label>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <input name="username" type="text" class="form-control" id="email" placeholder="Enter Your Username" required="">
                                            </fieldset>
                                        </div>
                                    </div>                              
                                    <div class="col-md-12">
                                        <label class="col-md-2 col-md-offset-2" for="from">Password </label>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <input name="password" type="password" class="form-control" id="name" placeholder="Enter Your Password" required="">
                                            </fieldset>
                                        </div>
                                    </div>                              
                                    <div class="col-md-12">
                                        <div class="col-md-2 col-md-offset-4">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn">Login</button>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            <fieldset>
                                                <a class="btn" href="<?= base_url().'account' ?>"><button class="btn"><i class="fa fa-home"></i> Homepage</button></a>
                                            </fieldset>
                                        </div>
                                    </div>   
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>