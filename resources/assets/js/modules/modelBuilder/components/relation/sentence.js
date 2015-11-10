import Mode from './Mode';

export default phrase;

function phrase(model1, model2){
    var sentence = [];

    if (model1.mode === Mode.ONE) {
        sentence.push(`One ${model1.label()} has`);
    } else {
        sentence.push(`Many ${model1.label()} have`);
    }

    if (model2.mode === Mode.ONE) {
        sentence.push('one');
    } else {
        sentence.push('many');
    }

    sentence.push(model2.label());

    return sentence.join(' ');
}