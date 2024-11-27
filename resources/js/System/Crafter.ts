import { Engine } from './Engine';

export class Crafter {
  engine: Engine;

  constructor(canvas: HTMLElement) {
    this.engine = new Engine(canvas);
  }
}

