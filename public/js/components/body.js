
import {Component} from 'react';
import Cities from './cities';
import Positions from './positions';

export default class Body extends Component {
    constructor(props) {
        super(props);
        this.state = {city: ''};
    }

    _setCity(city) {
        this.setState({city});
    }

    render() {
        return (
            <div className="ui grid">
                <div className="three wide column">
                    <Cities city={this.state.city} changeCity={this._setCity.bind(this)}/>
                </div>
                <div className="thirteen wide column">
                    <Positions city={this.state.city}/>
                </div>
            </div>
        );
    }
}
