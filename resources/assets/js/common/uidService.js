var id = 0;

/*@ngInject*/
export default function uidService(){
    return nextUid;
}

function nextUid(){
    return id++;
}