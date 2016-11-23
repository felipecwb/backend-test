
import {Component} from 'react';

Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));
    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

export default class Position extends Component {
    render() {
        const {title, description, salary, city_estate} = this.props.position;

        return (
            <div className="position">
                <h4>{title}</h4>
                <span><b>Local: </b>{city_estate}</span><br />
                <span><b>Salário: </b>R$ {salary.format(2, undefined, '.', ',')}</span><br />
                <div className="description" dangerouslySetInnerHTML={{__html: description}} />

                <div className="ui divider"></div>
            </div>
        );
    }
}
