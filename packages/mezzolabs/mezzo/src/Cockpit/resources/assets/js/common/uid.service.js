exports.name = 'uid';
exports.service = function inject(){
    return uid;
};
var id = 0;

function uid(){
    return id++;
}