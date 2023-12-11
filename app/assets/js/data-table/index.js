import { globalLocation, localLocation } from "./consts.js";
import { getSelect } from "./response.js";

getSelect(globalLocation ?? localLocation);