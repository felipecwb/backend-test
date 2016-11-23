
import {Component} from 'react';
import jQuery from 'jquery';
import axios from 'axios';

export default class Cities extends Component {
    constructor(props) {
        super(props);
        this.state = {cities: []};
    }

    componentDidMount() {
        axios.get('/api/position/locations').then(response => {
            this.setState({cities: response.data});
        });
    }

    click(e) {
        e.preventDefault();
        jQuery('div.ui.loader').show();
        jQuery('div.cities a.item.active').removeClass('active');
        let city = jQuery(e.target).addClass('active').text();

        if (city === 'Selecionar Todas') {
            city = '';
        }

        this.props.changeCity(city);
        jQuery('div.ui.loader').hide();
    }

    render() {
        return (
            <div className="ui shape">
                <h2 className="ui header blue">Cidades</h2>
                <div className="ui link list cities">
                    <a href="#positions" className="item active" onClick={this.click.bind(this)}>Selecionar Todas</a>
                    {this.state.cities.map(city => {
                        return <a href="#positions" className="item" onClick={this.click.bind(this)}>{city}</a>
                    })}
                </div>
            </div>
        );
    }
}
