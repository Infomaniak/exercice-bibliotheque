<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 22:15
 */
?>

<!-- The Modal -->
<div class="modal" id="edit_opinion_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modifier mon commentaire</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{Form::open(['url'=>route('opinion.update', ['id'=>0]), 'method'=>'PUT', 'id'=>'edit_opinion_modal_form'])}}
                <div class="d-block mb-2">
                    Titre
                    {{Form::text('title', null, ['class'=>'form-control', 'id'=>'edit_opinion_modal_title'])}}
                </div>
                <div class="d-block mt-2 mb-2">
                    Note
                    {{Form::number('grade', null, ['class'=>'form-control', 'min'=>0, 'max'=>5, 'id'=>'edit_opinion_modal_grade'])}}
                </div>
                <div class="d-block mt-2">
                    Description
                    {{Form::textarea('description', null, ['class'=>'form-control', 'id'=>'edit_opinion_modal_description'])}}
                </div>
                <input type="hidden" name="book_id" id="edit_opinion_modal_book_id">
                {{Form::close()}}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" form="edit_opinion_modal_form" class="btn btn-primary">Modifier</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
