const interpolation = (value, min, max, newMin, newMax) => {
    let newValue = ( (value-min) / (max-min) ) * (newMax-newMin) + newMin;
    return newValue;
}
export default interpolation;