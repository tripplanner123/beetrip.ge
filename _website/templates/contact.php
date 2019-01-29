<?php defined('DIR') OR exit; ?>

<main class="site__content">
  <div class="content">
      <div class="page-header bg-white">
          <div class="container">
              <h2 class="page-title text-center text-uppercase"><?=menu_title(129)?></h2>
          </div>
      </div>
      <div class="page-content pt-0">
          <div class="container">
              <div class="row">
                  <div class="offset-lg-2 col-lg-8">
                      <form action="?">
                          <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <div class="alert alert-warning g-message-contact" style="background-color:#f7f7f7; display: none;"></div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  
                                  <div class="form-group">
                                      <label class="w-100 form-label">
                                          <span class="form-label-text d-inline-block"><?=l("entername")?></span>
                                          <input type="text" class="form-control g-contact-entername" value="" />
                                      </label>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="form-group">
                                      <label class="w-100 form-label">
                                          <span class="form-label-text d-inline-block"><?=l("email")?></span>
                                          <input type="email" class="form-control g-contact-email" value="" />
                                      </label>
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <label class="w-100 form-label">
                                          <span class="form-label-text d-inline-block"><?=l("subject")?></span>
                                          <input type="text" class="form-control g-contact-subject" value="" />
                                      </label>
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="form-group mb-0">
                                      <label class="w-100 form-label">
                                          <span class="form-label-text d-inline-block"><?=l("message")?></span>
                                          <textarea class="form-control g-contact-message"></textarea>
                                      </label>
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="text-center">
                                      <button type="button" class="button button--yellow button--form-submit g-contact-send"><?=l("send")?></button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
 <!-- content -->

<script src="_website/minJs/default.min.js"></script>
<script type="text/javascript">
  // add active to menu link
  var link = document.getElementsByClassName("g-feedback");
  link[0].className += " active";
</script>