<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 24/12/2018
 * Time: 01:40
 */
?>

<!-- Modal -->
<div id="book_show_modal" class="modal fade" role="dialog">
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
                        <img class="bookProfilePhoto" ng-src="@{{bookUpModalCover}}" alt="Photo de profile"
                             style="margin-bottom: 44px">
                        <form action="@{{ bookUpModalFormAction }}" method="POST" accept-charset="utf-8" id="bookUpModalForm" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group row col-md-12">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo de couverture') }}</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" id="photo" name="photo"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6 col-xs-12">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="title" name="title" value="@{{ bookUpModalTitle }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6">
                                <label for="publication" class="col-md-4 col-form-label text-md-right">{{ __('Publication') }}</label>
                                <div class="col-md-12">
                                    <input type="date" class="form-control" id="publication" name="publication" value="@{{ bookUpModalPublication }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6">
                                <label for="ref" class="col-md-4 col-form-label text-md-right">{{ __('Référence') }}</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="ref" name="ref" value="@{{ bookUpModalRef }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantité') }}</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="quantity" min="0" name="quantity" value="@{{ bookUpModalQuantity }}"/>
                                </div>
                            </div>

                            <div class="form-group row col-md-6">
                                <label for="category_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Catégorie') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="category_id" name="category_id" value="@{{bookUpModalCatgId}}">
                                        <option disabled>Choisissez une catégorie...</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-6">
                                <label for="author_id" class="col-md-4 col-form-label text-md-right">{{ __('Auteur') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="author_id" name="author_id">
                                        <option disabled>Choisissez un auteur...</option>
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}">{{$author->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-12">
                                    <textarea type="text" class="form-control" id="description" name="description" style="height: 500px;">@{{ bookUpModalDescription }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="bookUpModalForm" class="btn btn-primary">Modifier</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
