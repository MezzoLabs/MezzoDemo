import Component from '../Component';
import Model from './Model';
import Mode from './Mode';
import sentence from './sentence';
import alphabetical from './alphabetical';

const Position = {
    LEFT: 0,
    RIGHT: 1
};

module.exports = new Component('mezzoRelation', 'relation/relation.html', modifyOptions);

function modifyOptions(options) {
    options.models = [
        new Model(1, 'User'),
        new Model(2, 'Category')
    ];
    options.leftModel = new Model(0, 'Tutorial');
    options.rightModel = options.models[0];
    options.title = null;
    options.columnPosition = Position.LEFT;
    options.pivotTable = null;
    options.Mode = Mode;
    options.Position = Position;

    options.sentence = () => sentence(options.leftModel, options.rightModel);
    options.onModelUpdate = onModelUpdate;
    options.showPivotTable = () => options.leftModel.mode === Mode.MANY && options.rightModel.mode === Mode.MANY;
    options.showLeftColumn = () => options.columnPosition === Position.LEFT && !options.showPivotTable();
    options.showRightColumn = () => options.columnPosition === Position.RIGHT && !options.showPivotTable();
    options.hasOrHave = () => options.leftModel.mode === Mode.ONE ? 'has' : 'have';

    onModelUpdate();

    function onModelUpdate(){
        options.title = options.rightModel.label();
        options.pivotTable = getPivotTableName();

        options.rightModel.updateNaming();
        options.rightModel.updateColumn();
    }

    function getPivotTableName(){
        var modelNames = [ options.leftModel.name.toLowerCase(), options.rightModel.name.toLocaleLowerCase() ];
        var sortedNames = modelNames.sort(alphabetical);

        return sortedNames.join('_');
    }
}