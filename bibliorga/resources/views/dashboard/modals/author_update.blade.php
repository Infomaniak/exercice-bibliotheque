<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 24/12/2018
 * Time: 01:40
 */
?>

<!-- Modal -->
<div id="author_show_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modifier un livre</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <img class="authorProfilePhoto" ng-src="@{{authorUpModalCover}}" alt="Photo de profile"
                             style="margin-bottom: 44px">
                        <form action="@{{ authorUpModalFormAction }}" method="POST" accept-charset="utf-8" id="authorUpModalForm" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group row col-md-12">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo de couverture') }}</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" id="photo" name="photo"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6 col-xs-12">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="@{{ authorUpModalFirstName }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6 col-xs-12">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="@{{ authorUpModalLastName }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="biography" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-12">
                                    <textarea type="text" class="form-control" id="biography" name="biography" style="height: 500px;">@{{ authorUpModalBiography }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="authorUpModalForm" class="btn btn-primary">Modifier</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
