import { globalLocation, localLocation } from "./consts.js";
import { getSelect } from "./response.js";

let something = await getSelect(globalLocation ?? localLocation);