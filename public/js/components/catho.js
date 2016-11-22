
import {Component} from 'react';
import Header from './header'

export default class Catho extends Component {
    render() {
        return (
            <div className="ui raised very padded container segment">
                <Header />
                <hr />
                <div>
                    {this.props.children}
                </div>
            </div>
        );
    }
}
