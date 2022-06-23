<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="">Titulo</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <textarea class="form-control" name="descricao" id="" rows="10"><?=$obVaga->descricao?></textarea>
        </div>

        <div class="form-group">
            <label for="">Status</label>
            
            <div>
                <div class="form-check form-check-inline">
                    <label for="" class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label for="" class="form-control">
                        <input type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : '' ?>> Inativo
                    </label>
                </div>

            </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</main>