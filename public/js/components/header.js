
import {Component} from 'react';

export default class Header extends Component {
    render() {
        return (
            <div className="ui header grid">
                <div className="six wide column"></div>
                <div className="two wide column">
                    <img src="http://static.catho.com.br/svg/site/logoCathoB2c.svg" alt="Catho"/>
                </div>
            </div>
        );
    }
}
