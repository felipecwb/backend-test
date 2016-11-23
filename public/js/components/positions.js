
import {Component} from 'react';
import SearchForm from './search-form';
import Position from './position';
import jQuery from 'jquery';
import axios from 'axios';

export default class Positions extends Component {
    constructor(props) {
        super(props);
        this.state = {positions: []};
    }

    componentDidMount() {
        this._update();
    }

    _update(search = null, order = null) {
        jQuery('div.ui.loader').show();

        let config = {params: {}};

        if (search) {
            config.params = search;
        }

        if (order) {
            config.params.salary_order = order;
        }

        axios.get('/api/position', config).then(response => {
            jQuery('div.ui.loader').hide();
            this.setState({positions: response.data});
        });
    }

    render() {
        let {positions} = this.state;
        let {city} = this.props;

        if (city !== '') {
            positions = positions.filter(p => {
                return p.city_estate === city;
            });
        }

        return (
            <div>
                <SearchForm update={this._update.bind(this)}/>
                {city ? (<span>Apenas vagas na cidade de <b>{city}</b></span>) : null}
                <div className="ui divider"></div>
                <div className="ui active centered inline loader"></div>
                <div id="positions">
                    {positions.map(p => <Position position={p}/>)}
                </div>
            </div>
        );
    }
}
