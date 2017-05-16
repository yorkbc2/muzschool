<div class="__edit">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="__edit_form" action="<?php $ms->get_basepath(); ?>/edit/post/<?php echo $postId; ?>"
        method="post" enctype="multipart/form-data">
                    <div>
                        <input type="text" value="<?php echo $pageItem['name']; ?>">
                    </div>
                    <div>
                        <textarea id='edit_form'>
                            <?php
                                echo $contentItem;
                            ?>
                        </textarea>
                    </div>
                    <div>
                        <button class='btn btn-primary' type='submit'>Редагувати</button>
                        <button class='btn btn-danger' type='reset'>Стерти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>

    $("#edit_form").froalaEditor().css("height", "320px")

</script>

<style>
    .__edit_form {

        width: 100%;
        display: block;

    }

    .__edit_form input {
        width: 100%;
        padding: 4px 7px;
        font-size: 1.2em;
        font-family: "Roboto", sans-serif;
        margin: 10px 0;

        border: 2px solid royalblue;
        border-color: transparent transparent royalblue transparent;

        outline:none;
    }

    .__edit_form textarea#edit_form {
        width: 100%;
        height: 320px;
        resize: none;
        overflow-y: auto;
        word-wrap: break-word;
    }
</style>