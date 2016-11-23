
import {Component} from 'react';
import jQuery from 'jquery';


export default class SearchForm extends Component {

    find(e) {
        e.preventDefault();

        clearTimeout(this.findTimeout);
        this.findTimeout = setTimeout(() => {
            let $form = jQuery('#search-form');
            let field = $form.find('[name=field]').val(),
                search = $form.find('[name=search]').val(),
                order = $form.find('[name=order]').val();

            let s = {};
            s[field] = search;

            if (search.length < 3) {
                s = null;
            }

            if (order == '') {
                order = null;
            }

            this.props.update(s, order);
        }, 700);
    }

    render() {
        return (
            <form id="search-form" className="ui form" onSubmit={this.find.bind(this)}>
                <div className="twelve fields">
                    <div className="three wide field">
                        <select className="ui fluid dropdown" name="field" onChange={this.find.bind(this)}>
                            <option value="title">Titulo</option>
                            <option value="description">Descrição</option>
                        </select>
                    </div>
                    <div className="ten wide field">
                        <input type="text" name='search' placeholder="Pesquisar" onChange={this.find.bind(this)}/>
                    </div>
                    <div className="field">
                        <button className="ui button primary">Pesquisar</button>
                    </div>
                </div>
                <div className="fields right floated content">
                    <div className="three wide field">
                        <label>Ordenar: </label>
                        <select className="ui fluid dropdown" name="order" onChange={this.find.bind(this)}>
                            <option value="">Selecione</option>
                            <option value="desc">Maior Salário</option>
                            <option value="asc">Menor Salário</option>
                        </select>
                    </div>
                </div>
            </form>
        );
    }
}
