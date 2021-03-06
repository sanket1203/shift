<section class="single-ticket">
    <div class="container-fluid">    
        <div class="row">
            <div class="col-xl-2 offset-xl-2">
                <ul class="nav nav-tabs">
                    <li>
                        <h3>
                            <?php echo $this->lang->line('last_tickets'); ?>
                        </h3>
                        <ul class="list-group">
                            <?php
                            if ( $tickets ) {
                                
                                foreach ( $tickets as $tick ) {
                                    
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('user/get-ticket/' . $tick->ticket_id) ?>">
                                            <?php echo $tick->subject; ?>
                                        </a>
                                    </li>
                                    <?php
                                    
                                }
                                
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-xl-6">
                <div class="settings-list">
                    <div class="tab-content">
                        <div class="tab-pane container fade active show" id="main-settings">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="<?php echo site_url('user/faq-page') ?>">
                                                    <?php echo $this->lang->line('support_center'); ?>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <?php
                                                    echo @$ticket[0]->subject;
                                                ?>
                                            </li> 
                                        </ol>
                                    </nav>
                                </div>
                                <div class="panel-body">
                                    <div class="article">
                                        <h1 class="title">
                                            <?php
                                            echo @$ticket[0]->subject;
                                            ?>
                                        </h1>
                                        <?php
                                        echo @$ticket[0]->body;
                                        ?>   
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="ticket_status">
                                        <div class="row">
                                            <div class="col-8">
                                                <p>
                                                    <?php echo $this->lang->line('status'); ?>
                                                </p>
                                            </div>
                                            <div class="col-4 text-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle ticket-status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?php
                                                        if ( (int)$ticket[0]->status > 0 ) {

                                                            echo $this->lang->line('active');

                                                        } else {

                                                            echo $this->lang->line('closed');

                                                        }
                                                        ?>
                                                    </button>
                                                    <div class="dropdown-menu change-ticket-status">
                                                        <a class="dropdown-item" href="#" data-id="1">
                                                            <?php echo $this->lang->line('active'); ?>
                                                        </a>                                                        
                                                        <a class="dropdown-item" href="#" data-id="0">
                                                            <?php echo $this->lang->line('closed'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form">
                    <div class="comment-form-area">
                        <?php echo form_open('user/get-ticket/' . $tick->ticket_id, array('class' => 'submit-ticket-reply', 'data-csrf' => $this->security->get_csrf_token_name())) ?>
                            <textarea placeholder="<?php echo $this->lang->line('enter_your_reply_here'); ?>" class="reply-body"></textarea>
                            <input type="hidden" class="reply-ticket-id" value="<?php echo $ticket[0]->ticket_id; ?>"> 
                            <button type="submit" class="btn btn-success green">
                                <i class="fa fa-share"></i>
                                <?php echo $this->lang->line('reply'); ?>
                            </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="replies-list">
                    <div class="ticket-replies">
                        
                    </div>
                </div>
            </div>        
        </div>
    </div>
</section>

<button type="button" class="btn btn-primary btn-help-open-ticket" data-toggle="modal" data-target="#tickets-popup">
    <i class="icon-question"></i>
    <?php echo $this->lang->line('help'); ?>
</button>

<!-- Modal -->
<div class="modal fade" id="tickets-popup" tabindex="-1" role="dialog" aria-labelledby="accounts-manager-popup" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open('user/faq-page', array('class' => 'submit-new-ticket', 'data-csrf' => $this->security->get_csrf_token_name())) ?>
                <div class="modal-header">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active show" id="nav-new-ticket-tab" data-toggle="tab" href="#nav-new-ticket" role="tab" aria-controls="nav-new-ticket" aria-selected="true">
                               <?php echo $this->lang->line('new_ticket'); ?> 
                            </a>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </nav>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-new-ticket" role="tabpanel" aria-labelledby="nav-new-ticket">
                            <div class="form-group">
                                <input type="text" class="form-control ticket-subject" placeholder="<?php echo $this->lang->line('ticket_subject'); ?>" autocomplete="off" required="required">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control ticket-body" placeholder="<?php echo $this->lang->line('enter_your_question_here'); ?>"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-type="main" class="btn btn-primary pull-right">
                        <?php echo $this->lang->line('submit_ticket'); ?>
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>