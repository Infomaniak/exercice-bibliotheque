<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 24/12/2018
 * Time: 01:40
 */
?>

<!-- Modal -->
<div id="user_show_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Utilisateur</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <img class="userProfilePhoto" ng-src="@{{userUpModalCover}}" alt="Photo de profile"
                             style="margin-bottom: 44px">
                        <form action="@{{ userUpModalFormAction }}" method="POST" accept-charset="utf-8" id="userUpModalForm">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <div class="col-md-6">
                                <input type="text" name="lastname" class="form-control"
                                       value="@{{userUpModalLastName}}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="firstname" class="form-control"
                                       value="@{{userUpModalFirstName}}">
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" value="@{{userUpModalEmail}}">
                            </div>
                            <div class="col-md-3">
                                <select type="text" name="role" class="form-control" value="@{{userUpModalRole}}">
                                    <option value="admin">Administrateur</option>
                                    <option value="librarian">Bibliothéquiare</option>
                                    <option value="user">Utilisateur</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                statut
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="userUpModalForm" class="btn btn-primary">Modifier</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
