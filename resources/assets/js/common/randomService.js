/*@ngInject*/
export default function randomService(){
    return {
        string
    };
}

function string(length = 5){
    const startIndex = 2;

    return (new Date() * Math.random()).toString(36).slice(startIndex, startIndex + length);
}