import { Data } from "./consts.js";

export async function getSelect(locationURL) {
    const response = await fetch(locationURL + 'select.php', Data.POST({
        Msg: "Hi"
    }));

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    if (data.status !== 500) {
        console.log(data);
    } else {
        console.warn('We found an error looking for your data');
    }
}