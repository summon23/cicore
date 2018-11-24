<?php
    extract($modeloptions);
?>
<div class="m-content">
    <?php $this->load->view('themes/'.THEME.'/alert');?>
    <div class="row">
        <div class="col-md-8 col-sm-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <?php echo $pagetitle;?>
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?php echo base_url().$route.'/action/save';?>">
                    <div class="m-portlet__body">
                        <!-- <div class="form-group m-form__group m--margin-top-10">
                            <div class="alert m-alert m-alert--default" role="alert">
                                The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                            </div>
                        </div> -->

                        <?php foreach ($modelfield as $key => $value) :?>
                            <?php switch ($value['type']) {
                                case 'hidden': ?>
                                    <input type="hidden" name="<?php echo $value['name'];?>">
                                <?php break;
                                case 'password':
                                case 'email':
                                case 'text': ?>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1"><?php echo $value['fieldname'];?></label>
                                        <input type="<?php echo $value['type'];?>" name="<?php echo $value['name'];?>" class="form-control m-input" id="exampleInputEmail1" placeholder="">
                                        <!-- <span class="m-form__help">We'll never share your email with anyone else.</span> -->
                                    </div>
                                <?php break;
                                case 'textarea': ?>
                                    <div class="form-group m-form__group">
                                        <label for="exampleTextarea">Example textarea</label>
                                        <textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                <?php break;
                                case 'dropdown'; ?>
                                    <div class="form-group m-form__group">
                                        <label for="exampleSelect1">Example select</label>
                                        <select class="form-control m-input" id="exampleSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                <?php break;
                                default:                                    
                                    break;
                            } ?>
                        <?php endforeach;?>                                    
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onClick="window.history.back();"class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->
        </div>
    </div>
</div>