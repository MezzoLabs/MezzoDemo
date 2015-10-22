var id = 0;

export default { name: 'uid', service };

/*@ngInject*/ function service(){
    return uid;
}

function uid(){
    return id++;
}