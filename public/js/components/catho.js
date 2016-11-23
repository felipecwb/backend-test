
import {Component} from 'react';
import Header from './header';
import Body from './body';

export default class Catho extends Component {
    render() {
        return (
            <div className="ui raised very padded container segment">
                <Header />
                <div className="ui divider"></div>
                <Body />
            </div>
        );
    }
}
