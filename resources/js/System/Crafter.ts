import { Engine } from '@/System/Engine';

export class Crafter {
  engine: Engine;

  constructor(canvas: HTMLElement) {
    this.engine = new Engine(canvas);
  }
}

