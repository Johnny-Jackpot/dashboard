<?php require_once(ROOT . '/views/layouts/header.php'); ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <br />
        <a href="/user/logout" class="navbar-right">Log out</a>
    </div>
</nav>

<div class="row">
    <div id="heading">
        <div class="col-md-8 col-md-offset-2" style="text-align: center">
            <h1 id="pageName"><?php echo htmlspecialchars($pageName); ?></h1>
        </div>
        <div class="col-md-1">
            <button id="editName" 
                    type="button" 
                    class="btn btn-primary">Edit name</button>
        </div>
    </div>
    <div id="headingForm" style="display: none;">
        <form id="pageNameForm">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <input id="inputPageName" 
                           type="text" 
                           class="form-control" 
                           name="pageName" 
                           maxlength="100">
                </div>
            </div>
            <div class="col-md-1">
                <button id="submitPageName" 
                        type="submit" 
                        class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div id="description">
        <div class="col-md-8 col-md-offset-2">
            <p id="pageDescription" style="text-align: justify;"><?php echo htmlspecialchars($pageDescription); ?></p>
        </div>
        <div class="col-md-1">
            <button id="editDescription" 
                    type="button" 
                    class="btn btn-primary">Edit description</button>
        </div>
    </div>
    <div id="descriptionForm" style="display: none;">
        <form id="pageDescriptionForm">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <textarea id="inputPageDescription" 
                              class="form-control" 
                              name="inputPageDescription" 
                              maxlength="2000" rows="10"></textarea>
                </div>
            </div>
            <div class="col-md-1">
                <button id="submitPageDescription" 
                        type="submit" 
                        class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <br/>
    <br/>
    <h3 style="text-align: center;">Feedback</h3>
    <div class="col-md-4 col-md-offset-4">
        <form id="feedback">
            <div class="form-group">
                <input id="userName" 
                       class="form-control" 
                       type="text" 
                       name="userName" 
                       placeholder="Name"
                       required/>
            </div>
            <div class="form-group">
                <input id="userEmail" 
                       class="form-control" 
                       type="email" 
                       name="userEmail" 
                       placeholder="Email"
                       required/>
            </div>
            <div class="form-group">
                <textarea id="userFeedback" 
                          class="form-control" 
                          name="userFeedback" 
                          maxlength="1000" 
                          rows="10"
                          placeholder="Message"
                          required></textarea>
            </div>
            <button id="submitFeedback" 
                    type="submit" 
                    class="btn btn-primary">Send</button>

        </form>
    </div>
</div>

<div id="dragabbleImage" 
     style="
     position: absolute;
     z-index: 10000;
     width: 100px; 
     height: 100px; 
     background-color: #000000; 
     color: #ffffff;">
    Dragabble
</div>


<?php
require_once(ROOT . '/views/layouts/footer.php');
