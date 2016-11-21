<!DOCTYPE html>
<html lang="br">
    <head>
        <title>Vagas - Catho</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/styles.css">
    </head>
    <body id="root">
        <div class="ui raised very padded container segment">
            <div class="ui header grid">
                <div class="six wide column"></div>
                <div class="two wide column">
                    <img src="http://static.catho.com.br/svg/site/logoCathoB2c.svg" alt="Catho"/>
                </div>
            </div>
            <hr />
            <br />
            <div id="intern" class="ui grid">
                <div class="three wide column"></div>
                <div class="ten wide column">
                    <form class="ui form">
                        <div class="twelve fields">
                            <div class="three wide field">
                                <select class="ui fluid dropdown">
                                    <option value="title">Titulo</option>
                                    <option value="description">Descrição</option>
                                </select>
                            </div>
                            <div class="ten wide field">
                                <input type="text" name='search' placeholder="Pesquisar" />
                            </div>
                            <div class="field">
                                <button class="ui button primary">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>

                <article id="positions" class="twelve wide column">
                    <section class="position">
                        <h4>Vaga</h4>
                        <b>Cidade - UF</b><br>
                        <b>Salário: </b> <span style="ui red">$ 3.000,00</span>
                        <blockquote class="details">
                            
                        </blockquote>
                    </section>
                </article>

            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js"></script>
        <script src="/assets/all.js"></script>
    </body>
</html>
